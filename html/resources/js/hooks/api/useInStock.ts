import useApi from './useApi';
import { GetItemData } from './useItems';
import { useForm as useInertiaForm } from '@inertiajs/inertia-vue3';
import useDisplayError, { isValidationError } from '../useDisplayError';
import { defineComponent, h, ref } from 'vue';
import dayjs from 'dayjs';

export type InStockData = {
  produce_user_id: number
  import_date: string
  warehouse_id: number
  reason: string
  in_stock_details:
  {
    item_id: number
    item_quantity: number
  }[]
}


export type QueryParam = Partial<InStockData>
export type InvalidError = ValidationError<InStockData>

const useInStockData = (items?:GetItemData[]) => {

  const { fetch: fetchApi, create: createApi} = useApi('InStockInfo');
 
  const DisplayError = useDisplayError<InStockData>()

  const error = ref<InvalidError|undefined>(undefined)
  const fetch = async (query?: QueryParam) => await fetchApi<InStockData[], QueryParam>(query)

  const form = useInertiaForm<InStockData>({
      produce_user_id: 0,
      import_date: dayjs().format('YYYY-MM-DD'),
      warehouse_id: 0,
      reason: "",
      in_stock_details: (items??[]).map(item => ({
        item_id: item.id,
        item_quantity: 0
      }))
    })
  

  const post = async (formData: typeof form) => {
    try{
      return await createApi<InStockData>(formData)
    }catch(e){
      if(isValidationError<InStockData>(e)){
        error.value = e
      }
      throw e
    }
  }
  const InvalidError = defineComponent<{field: keyof InStockData}>(function InvalidError(props) {
    return () => h(DisplayError, {errors:error.value?.data.errors, field: props.field})
  })

  return {
    fetch,
    form,
    post,
    InvalidError
  };
};

export default useInStockData