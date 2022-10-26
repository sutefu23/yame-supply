import useApi from './useApi';

export type MasterType = "Warehouse" | "Unit" | "WoodSpecies" | "UserCategory"

type MasterData = {
  id: number,
  name: string
}

export type UnitType = MasterData
export type WarehouseType = MasterData 
export type WoodSpeciesType = MasterData
export type UserCategoryType = MasterData

export type WhichMaster = UserCategoryType | UnitType | WarehouseType | WoodSpeciesType

export type UpdateMasterData = Partial<Omit<MasterData, "id">>


const useMaster = (masterType: MasterType) => {
  const {fetch: fetchApi, update: updateApi, create: createApi, destoroy: destoroyApi} = useApi(masterType);
  
  const fetch = async () => await fetchApi<MasterData[]>()

  const update =  async (data: UpdateMasterData, id: number) => await updateApi<UpdateMasterData>(data, id)

  const create =  async (data: MasterData) => await createApi<MasterData>(data)

  const destoroy =  async (id: number) => await destoroyApi<MasterData>(id)

  return {
    fetch,
    update,
    create,
    destoroy
  };
};

export default useMaster