import type { Page } from '@inertiajs/inertia'
declare function route(name?:string, params?: any);

declare module '@vue/runtime-core' {
  declare function route(name?:string, params?: any);
  
  type UserProp = {
    auth:{
      name: string,
      email: string,  
    }
  }

  interface ComponentCustomProperties  {
    route : typeof route
    $page: Page<UserProp>
  }
}
export {}