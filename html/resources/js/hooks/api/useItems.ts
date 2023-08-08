import useApi from "./useApi";
import { WoodSpeciesType, UnitType, WarehouseType } from "./useMaster";

export type ItemData = {
    id: number;
    length: number;
    width: number;
    thickness: number;
    raw_wood_size: string;
    warehouse_id: number;
    memo: string;
    quantity: number;
    essential_quantity: number;
    build_quantity: number;
    current_month_quantity: number;
    next_month_quantity: number;
    unit_id: number;
    wood_species_id: number;
    defective_quantity: number;
    manufacturing_quantity: number;
    raw_wood_arrival_quantity: number;
    raw_wood_arrangement_quantity: number;
};

export type GetItemData = ItemData & { wood_species: WoodSpeciesType } & {
    unit: UnitType;
} & { warehouse: WarehouseType };
export type UpdateItemData = Partial<Omit<ItemData, "id">>;
export type QueryParam = Partial<Omit<ItemData, "id">>;
const useItems = () => {
    const { fetch: fetchApi, update: updateApi } = useApi("items");

    const fetch = async (query?: QueryParam) =>
        await fetchApi<GetItemData[], QueryParam>(query);

    const update = async (data: UpdateItemData, id: number) =>
        await updateApi<UpdateItemData>(data, id);

    return {
        fetch,
        update,
    };
};

export default useItems;
