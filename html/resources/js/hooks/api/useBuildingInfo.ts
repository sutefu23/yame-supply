import useApi from "./useApi";
import { GetItemData } from "./useItems";
import { useForm as useInertiaForm, usePage } from "@inertiajs/inertia-vue3";
import useDisplayError, { isValidationError } from "../useDisplayError";
import { defineComponent, h, ref } from "vue";
import { UserData } from "./useUsers";

export type BuildingInfoData = {
    id: number;
    field_name: string;
    builder_user_id: number;
    export_expected_date: string;
    export_fix_date: string;
    is_exported: boolean;
    building_info_details: {
        item_id: number;
        item_quantity: number;
    }[];
};

export type QueryParam = {
    id?: number;
    is_exported?: boolean;
};

export type GetBuilingInfoData = BuildingInfoData & { user: UserData } & {
    readonly created_at: Date;
};
export type UpdateBuilingInfoData = Partial<Omit<BuildingInfoData, "id">>;
export type InvalidError = ValidationError<BuildingInfoData>;

const useBuildingInfoData = () => {
    const {
        fetch: fetchApi,
        update: updateApi,
        create: createApi,
        destoroy: deleteApi,
    } = useApi("BuildingInfo");

    const { props } = usePage<{ Items: GetItemData[] }>();
    const items = props.value.Items;

    const DisplayError = useDisplayError<BuildingInfoData>();

    const error = ref<InvalidError | undefined>(undefined);
    const fetch = async (query?: QueryParam) =>
        await fetchApi<GetBuilingInfoData[], QueryParam>(query);

    const form = useInertiaForm<UpdateBuilingInfoData>({
        field_name: "",
        builder_user_id: 0,
        export_expected_date: "",
        export_fix_date: "",
        building_info_details: items.map((item) => ({
            item_id: item.id,
            item_quantity: item.essential_quantity,
        })),
    });

    const update = async (id: BuildingInfoData["id"]) => {
        try {
            return await updateApi<UpdateBuilingInfoData>(form, id);
        } catch (e) {
            if (isValidationError<UpdateBuilingInfoData>(e)) {
                error.value = e;
            }
            throw e;
        }
    };

    const post = async () => {
        try {
            return await createApi<UpdateBuilingInfoData>(form);
        } catch (e) {
            if (isValidationError<UpdateBuilingInfoData>(e)) {
                error.value = e;
            }
            throw e;
        }
    };

    const destoroy = async (id: number) => {
        try {
            return await deleteApi(id);
        } catch (e) {
            if (isValidationError<UpdateBuilingInfoData>(e)) {
                error.value = e;
            }
            throw e;
        }
    };

    const InvalidError = defineComponent<{ field: keyof BuildingInfoData }>(
        function InvalidError(props) {
            return () =>
                h(DisplayError, {
                    errors: error.value?.data.errors,
                    field: props.field,
                });
        }
    );

    return {
        fetch,
        form,
        update,
        post,
        destoroy,
        InvalidError,
    };
};

export default useBuildingInfoData;
