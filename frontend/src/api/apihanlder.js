
import axios from 'axios';

// Create an Axios instance with default configuration
const api = axios.create({
    withCredentials:true,
  baseURL: 'http://localhost:8000',
  headers:{
    Accept:"application/json"
  }
});


export function getInstance(){
    return api;
}
// Use the Axios instance to make API requests
export function getDocuments(){

   return  api.get('documents/')
    .then((response) => console.log(response.data))
    .catch((error) => console.error(error));
}
  
export function  getLinks(){
    return api.get("links/").then((response)=>response);
}