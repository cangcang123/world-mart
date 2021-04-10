export default {
    namespaced: true,
    state: {
        oa_id: '',
        search: '',
        searchUsers: [],
        searchMessages: [],
        focusSearch: false,
        messagePage: false,
        activeUser: null,
        hasMessage: false,
    },
    mutations: {
        OA_ID(state, oa_id) {
            state.oa_id = oa_id
        },
        SEARCH(state, value) {
            state.search = value
        },
        FOCUS_SEARCH(state, isFocus) {
            state.focusSearch = Boolean(isFocus)
        },
        ACTIVE_USER(state, user) {
            state.activeUser = user
        },
        MESSAGE_PAGE(state, isPage) {
            state.messagePage = isPage
        },
        SEARCH_USERS(state, users) {
            state.searchUsers = users
        },
        SEARCH_MESSAGES(state, messages) {
            state.searchMessages = messages
        },
        HAS_MESSAGE(state, value) {
            state.hasMessage = value
        }
    },
    actions: {
        messagePage({ commit }, isPage) {
            commit('MESSAGE_PAGE', isPage)
        }
    }
}
