import useApi from './useApi';
import { GetItemData } from './useItems';
import { useForm as useInertiaForm, usePage } from '@inertiajs/inertia-vue3';
import useDisplayError, { isValidationError } from '../useDisplayError';
import { defineComponent, h, ref } from 'vue';
import dayjs from 'dayjs';

export type OutStockData = {
  builder_user_id: number
  export_date: string
  warehouse_id: number
  reason: string
  building_info_id: number
  out_stock_details:
  {
    item_id: number
    item_quantity: number
  }[]
}


export type QueryParam = Partial<OutStockData>
export type InvalidError = ValidationError<OutStockData>

const useOutStockData = () => {

  const { fetch: fetchApi, create: createApi} = useApi('OutStockInfo');
  const { props } = usePage<{ Items: GetItemData[] }>()
  const items = props.value.Items
   
  const DisplayError = useDisplayError<OutStockData>()

  const error = ref<InvalidError|undefined>(undefined)
  const fetch = async (query?: QueryParam) => await fetchApi<OutStockData[], QueryParam>(query)

  const form = useInertiaForm<OutStockData>({
      builder_user_id: 0,
      export_date: dayjs().format('YYYY-MM-DD'),
      warehouse_id: 0,
      reason: "",
      building_info_id: 0,
      out_stock_details: items.map(item => ({
        item_id: item.id,
        item_quantity: 0
      }))
    })
  

  const post = async () => {
    try{
      return await createApi<OutStockData>(form)
    }catch(e){
      if(isValidationError<OutStockData>(e)){
        error.value = e
      }
      throw e
    }
  }
  const InvalidError = defineComponent<{field: keyof OutStockData}>(function InvalidError(props) {
    return () => h(DisplayError, {errors:error.value?.data.errors, field: props.field})
  })

  return {
    fetch,
    form,
    post,
    InvalidError
  };
};

export default useOutStockData