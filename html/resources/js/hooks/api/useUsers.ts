import useApi from './useApi';
import { UserCategoryType } from './useMaster';
import useDisplayError, { isValidationError } from '../useDisplayError';
import { defineComponent, h, ref } from 'vue';
import { useForm as useInertiaForm, usePage } from '@inertiajs/inertia-vue3';

export type UserData = {
  id: number,
  name: string,
  user_category_id: UserCategoryType["id"]
  email: string,
}

export type GetUserData = UserData & { user_category: UserCategoryType }
export type UpdateUserData = UserData & {password: string, password_confirmation: string}
export type QueryParam = Partial<UserData>
export type InvalidError = ValidationError<UpdateUserData>
export type UserCategoryValue = "製材所" | "工務店" | "森林組合" | "流通" | "事務局"

const useUser = (category?: UserCategoryValue) => {

  const { fetch: fetchApi, update: updateApi, create: createApi, destoroy: destoroyApi} = useApi('users');
  
  const { props } = usePage();
  const userCategories = props.value.UserCategory
  const DisplayError = useDisplayError<UpdateUserData>()

  const error = ref<InvalidError|undefined>(undefined)

  const fetch = async (query?: QueryParam) => {
    const user_category_id = (() => {if(category){
      return userCategories.filter(cat => cat.name === category)[0].id
    }})()

    return await fetchApi<GetUserData[], QueryParam>({...query, user_category_id})
  }

  const form = useInertiaForm<UpdateUserData>({
    id:0,
    name: '',
    email: '',
    user_category_id: 0,
    password: '',
    password_confirmation: '',
  })

  const update = async (id: UserData["id"]) => {
    try{
      return await updateApi<UpdateUserData>(form, id)
    }catch(e){
      if(isValidationError<UpdateUserData>(e)){
        error.value = e
      }
      throw e
    }
  }

  const post = async () => {
    try{
      return await createApi<UpdateUserData>(form)
    }catch(e){
      if(isValidationError<UpdateUserData>(e)){
        error.value = e
      }
      throw e
    }
  }
  const InvalidError = defineComponent<{field: keyof UpdateUserData}>(function InvalidError(props) {
    return () => h(DisplayError, {errors:error.value?.data.errors, field: props.field})
  })


  const destoroy = async (id: number) => await destoroyApi<UpdateUserData>(id)

  return {
    fetch,
    form,
    update,
    post,
    destoroy,
    InvalidError
  };
};

export default useUser