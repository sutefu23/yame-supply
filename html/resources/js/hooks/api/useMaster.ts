import useApi from './useApi';
import useDisplayError, { isValidationError } from '../useDisplayError';
import { defineComponent, h, ref } from 'vue';
import { useForm as useInertiaForm } from '@inertiajs/inertia-vue3';


export type MasterType = "Warehouse" | "Unit" | "WoodSpecies" | "UserCategory"
export type MasterTitle = "倉庫" | "単位" | "樹種" | "ユーザーカテゴリー"

export type MasterScheme = Record<MasterType, MasterTitle>

export const masterScheme:MasterScheme = {
  Warehouse:"倉庫",
  Unit:"単位",
  WoodSpecies:"樹種",
  UserCategory:"ユーザーカテゴリー"
} as const

type MasterData = {
  id: number,
  name: string
}
export type UnitType = MasterData
export type WarehouseType = MasterData 
export type WoodSpeciesType = MasterData
export type UserCategoryType = MasterData

export type WhichMaster = UserCategoryType | UnitType | WarehouseType | WoodSpeciesType

export type QueryParam = Partial<MasterData>
export type GetMasterData = MasterData 
export type UpdateMasterData = Partial<MasterData>

export type InvalidError = ValidationError<UpdateMasterData>

const useMaster = (masterType: MasterType) => {
  const DisplayError = useDisplayError<MasterData>()
  const error = ref<InvalidError|undefined>(undefined)

  const {fetch: fetchApi, update: updateApi, create: createApi, destoroy: destoroyApi} = useApi(masterType);
  
  const fetch = async (query?: QueryParam) => await fetchApi<GetMasterData[], QueryParam>({...query})

  const form = useInertiaForm<UpdateMasterData>({
    id:undefined,
    name: '',
  })

  const update = async (id: MasterData["id"]) => {
    try{
      return await updateApi<UpdateMasterData>(form, id)
    }catch(e){
      if(isValidationError<UpdateMasterData>(e)){
        error.value = e
      }
      throw e
    }
  }

  const post = async () => {
    try{
      return await createApi<UpdateMasterData>(form)
    }catch(e){
      if(isValidationError<UpdateMasterData>(e)){
        error.value = e
      }
      throw e
    }
  }
  const InvalidError = defineComponent<{field: keyof UpdateMasterData}>(function InvalidError(props) {
    return () => h(DisplayError, {errors:error.value?.data.errors, field: props.field})
  })


  const destoroy = async (id: number) => await destoroyApi<UpdateMasterData>(id)


  return {
    form,
    fetch,
    update,
    post,
    destoroy,
    InvalidError
  };
};

export default useMaster