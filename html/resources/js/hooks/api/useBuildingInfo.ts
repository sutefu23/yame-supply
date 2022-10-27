import useApi from './useApi';
import { GetItemData } from './useItems';
import { useForm as useInertiaForm } from '@inertiajs/inertia-vue3';
import useDisplayError, { isValidationError } from '../useDisplayError';
import { defineComponent, h, ref } from 'vue';
import dayjs from 'dayjs';
import { UserData } from './useUsers';

export type BuildingInfoData = {
  id: number,
  field_name: string
  builder_user_id: number
  time_limit: string
  building_info_details:
  {
    item_id: number
    item_quantity: number
  }[]
}


export type QueryParam = {
  id?: number,
}

export type GetBuilingInfoData = BuildingInfoData & { user: UserData} & { readonly created_at: Date }
export type UpdateBuilingInfoData = Partial<Omit<BuildingInfoData, "id">>
export type InvalidError = ValidationError<BuildingInfoData>

const useBuildingInfoData = (items?:GetItemData[]) => {

  const { fetch: fetchApi, create: createApi} = useApi('BuildingInfo');
 
  const DisplayError = useDisplayError<BuildingInfoData>()

  const error = ref<InvalidError|undefined>(undefined)
  const fetch = async (query?: QueryParam) => await fetchApi<GetBuilingInfoData[], QueryParam>(query)

  const form = useInertiaForm<UpdateBuilingInfoData>({
      field_name: "",
      builder_user_id: 0,
      time_limit: "",
      building_info_details: (items??[]).map(item => ({
        item_id: item.id,
        item_quantity: 0
      }))
    })
  

  const post = async (formData: typeof form) => {
    try{
      return await createApi<UpdateBuilingInfoData>(formData)
    }catch(e){
      if(isValidationError<UpdateBuilingInfoData>(e)){
        error.value = e
      }
      throw e
    }
  }
  const InvalidError = defineComponent<{field: keyof BuildingInfoData}>(function InvalidError(props) {
    return () => h(DisplayError, {errors:error.value?.data.errors, field: props.field})
  })

  return {
    fetch,
    form,
    post,
    InvalidError
  };
};

export default useBuildingInfoData