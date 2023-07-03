
import axios from 'axios';

// Create an Axios instance with default configuration
const api = axios.create({
    withCredentials:false,
  baseURL: 'http://localhost:8000/',
});

// Add an interceptor to catch cookies and send them with every request
export function getAxiosInstance(){
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