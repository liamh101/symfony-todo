const axios = require('axios');

export const itemMixin = {
    methods: {
        getSingleItem: (itemId) => axios.get(process.env.API_URL + '/items/' + itemId).then(response => response.data),
        getItems: (params) => axios.get(process.env.API_URL + '/items', {params}).then(response => response.data['hydra:member']),
        createItem: (name) => axios.post(process.env.API_URL + '/items', {name}).then(response => response.data),
        updateItem: (item) => axios.put(process.env.API_URL + '/items/' + item.id, item).then(response => response.data),
        removeItem: (itemId) => axios.delete(process.env.API_URL + '/items/' + itemId)
    }
};