const PREFIX = process.env.VUE_APP_LOCALSTORAGE_PREFIX || 'admin:'

export function getItem(key) {
    let text = localStorage.getItem(PREFIX + key)
    try {
        return JSON.parse(text)
    } catch (error) {
        return null
    }
}

export function setItem(key, value) {
    if (!value) {
        return localStorage.removeItem(PREFIX + key)
    }
    return localStorage.setItem(PREFIX + key, JSON.stringify(value))
}
