import axios from 'axios';

const useApi = (endPoint: string) => {
  const fetch = async <VReturn, Query = undefined> (query?: Query):Promise<VReturn> => {
    const res = await axios.get(`/api/${endPoint}`, {params: query});
    return res.data.data
  }

  const update = async <TParam, VReturn = void> (param:TParam, id: number): Promise<VReturn> => {
    const res = await axios.patch(`/api/${endPoint}/${id}`, param);
    return res.data.data
  }

  const create = async <TParam, VReturn = void> (param:TParam): Promise<VReturn> => {
    const res = await axios.post(`/api/${endPoint}`, param);
    return res.data.data
  }

  const destoroy = async <VReturn = void> (id: number): Promise<VReturn> => {
    const res = await axios.delete(`/api/${endPoint}/${id}`);
    return res.data.data
  }

  return {
    fetch,
    create,
    update,
    destoroy
  };
};

export default useApi