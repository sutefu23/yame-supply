import { AxiosError } from 'axios';
declare global {
  declare module "*.vue" {
    import Vue from 'vue'
    export default Vue
  }
  
  declare module "*.vue" {
    import type { DefineComponent } from "vue";
    const component: DefineComponent<Record<string, unknown>, Record<string, unknown>, unknown>;
    export default component;
  }

  declare function route(name?:string, params?: string|string[]);

  // Laravelのバリデーションメッセージ
  interface ValidationError<T> extends AxiosError["response"]{
    status: number
    data:{
      message: string
      errors:{
        [key in keyof T]?:string[]
      }  
    }
  }
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties{
    route : typeof route
  }
}

declare module '@inertiajs/inertia' {
  interface PageProps{
    auth:{
      user:{
        name: string,
        email: string,  
      }
    }
    UserCategory:[{
      id: number,
      name: string,
    }]
  }
}

export {}