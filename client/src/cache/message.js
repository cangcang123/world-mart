import localforage from 'localforage'

export default localforage.createInstance({
    name: process.env.VUE_APP_ID,
    storeName: 'message'
})
