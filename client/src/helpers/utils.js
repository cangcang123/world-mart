import upperFirst from 'lodash/upperFirst'
import { url } from 'vuelidate/lib/validators'

export function ltrim(char, str) {
    if (str.slice(0, char.length) === char) {
        return ltrim(char, str.slice(char.length))
    } else {
        return str
    }
}

export function rtrim(char, str) {
    if (str.slice(str.length - char.length) === char) {
        return rtrim(char, str.slice(0, 0 - char.length))
    } else {
        return str
    }
}

export function trim(char, str) {
    return rtrim(char, ltrim(char, str))
}

export function buildURL() {
    let args = Array.prototype.slice.call(arguments)
    return args.map(i => trim('/', String(i))).join('/')
}

export function fieldLabel(field) {
    return (
        field.label ||
        field.key
            .split(/[\.\_]/)
            .map(upperFirst)
            .join(' ')
    )
}

export function fieldErrorMessage(field, key, opts) {
    switch (key) {
        case 'required':
            return fieldLabel(field) + ' is required'
        case 'minLength':
            return `Please enter at least ${opts.min} characters`
        default:
            return fieldLabel(field) + ' ' + key + ' is invalid'
    }
}

export function str2Color(str = '', n = 255) {
    let hash = 0
    if (str.length === 0) return '#000000'
    for (let i = 0; i < str.length; i++) {
        hash = str.charCodeAt(i) + ((hash << 5) - hash)
        hash = hash & hash
    }
    let color = '#'
    for (let i = 0; i < 3; i++) {
        let value = (hash >> (i * 8)) & (n % 256)
        color += ('00' + value.toString(16)).substr(-2)
    }
    return color
}

export function isValidMessageData(data, type = 1) {
    let result = { valid: false, message: 'Lỗi không xác định' }
    if (!Array.isArray(data)) {
        result.message = 'Dữ liệu nội dung tin nhắn sai định dạng #invalid-array'
        return result
    }
    if (data.length == 0) {
        result.message = 'Nội dung tin nhắn trống'
        return result
    }

    if (type == 1) {
        result.valid = !data.some((item, index) => {
            if (!item.title) {
                result.message = index ? `Tiêu đề cho block nội dung tin nhắn thứ ${index + 1} trống` : 'Tiêu đề tin nhắn trống'
                return true
            }
            if (index === 0 && !item.description) {
                result.message = 'Mô tả tin nhắn trống'
                return true
            }
            if (!item.thumbnail) {
                result.message = index ? `Thiếu ảnh cho block nội dung tin nhắn thứ ${index + 1}` : 'Thiếu ảnh cho tin nhắn'
                return true
            }
            if (!item.url) {
                result.message = index ? `Thiếu liên kết cho block nội dung tin nhắn thứ ${index + 1}` : 'Thiếu liên kết'
                return true
            }

            if (!url(item.url)) {
                result.message = index ? `Liên kết cho block nội dung tin nhắn thứ ${index + 1} sai định dạng` : 'Liên kết sai định dạng'
                return true
            }

            return false
        })
    } else if (type == 2) {
        if (typeof data[0] == "string" && data[0].trim().length == 0) {
            result.message = 'Nội dung tin nhắn trống'
        } else {
            result.valid = true
        }
    }

    return result
}