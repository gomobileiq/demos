import api from './api';
import tableData from './table-data';

export const getData = () => api.get('api').then((response) => console.log(response));

export const getMapData = async () => tableData;

export const getOrders = async () => tableData;
