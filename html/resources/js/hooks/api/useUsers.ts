import useApi from './useApi';
import { UserCategoryType } from './useMaster';
import { usePage } from '@inertiajs/inertia-vue3';

export type UserData = {
  id: number,
  name: string,
  user_category_id: UserCategoryType["id"]
  email: string
}

export type GetUserData = UserData & { user_category: UserCategoryType }
export type CreateUserData = UserData & {password: string} 
export type UpdateUserData = Partial<Omit<UserData, "id">>
export type QueryParam = Partial<Omit<UserData, "id">>

export type UserCategoryValue = "製材所" | "工務店" | "森林組合" | "流通" | "事務局"

const useUser = (category?: UserCategoryValue) => {
  const { fetch: fetchApi, update: updateApi, create: createApi, destoroy: destoroyApi} = useApi('users');
  
  const { props } = usePage();
  const userCategories = props.value.UserCategory

  const fetch = async (query?: QueryParam) => {
    const user_category_id = (() => {if(category){
      return userCategories.filter(cat => cat.name === category)[0].id
    }})()

    return await fetchApi<GetUserData[], QueryParam>({...query, user_category_id})
  }

  const update =  async (data: UpdateUserData, id: number) => await updateApi<UpdateUserData>(data, id)

  const create =  async (data: CreateUserData) => await createApi<UpdateUserData>(data)

  const destoroy = async (id: number) => await destoroyApi<UpdateUserData>(id)

  return {
    fetch,
    update,
    create,
    destoroy
  };
};

export default useUser