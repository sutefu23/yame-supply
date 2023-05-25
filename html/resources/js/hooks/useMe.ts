import { usePage } from '@inertiajs/inertia-vue3';
const page = usePage()

const useMe = () => {
  const get = () => page.props.value.auth.user
  const isAdmin = () => get().user_category_id === 100
  const isManufacturer = () => get().user_category_id === 100 //製造
  return { get, isAdmin, isManufacturer}
}

export default useMe