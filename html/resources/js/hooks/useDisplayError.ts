import { Fragment, defineComponent, h } from 'vue';
import InputError from '@/Components/Input/InputError.vue'

const useDisplayError = <T>() => {
  type Props = {
    errors?: ValidationError<T>["data"]["errors"]
    field: keyof T
  }
  const ValidationError = defineComponent<Props>({
    name: "ValidationError",
    setup(props:Props){
      return () => h(InputError as unknown as typeof Fragment, {errors: props.errors, field: props.field})
    }
  })
  return ValidationError
}
const isValidationError = <T>(error: unknown): error is ValidationError<T> => {
  const typedObj = error as ValidationError<T>
  return (
    typedObj.status === 422 &&
    Object.prototype.hasOwnProperty.call(typedObj["data"],"errors")
  )
}
export { isValidationError }
export default useDisplayError

