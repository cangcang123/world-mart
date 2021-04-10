export default {
    namespaced: true,
    state: {
        connected: false,
        auth: false,
        invalid: false
    },
    mutations: {
        SOCKET_open(state) {
            state.connected = true
        },
        SOCKET_close(state) {
            state.connected = false
        },
        SOCKET_auth(state, payload) {
            state.auth = true
        },
        SOCKET_unauthorized(state, payload) {
            state.invalid = true
        }
    }
}
