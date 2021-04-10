import { ModeOfOperation, utils } from 'aes-js'

const key = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
const encrypted = false

export function decrypt(data) {
    if (!encrypted) return data
    let aesCtr = new ModeOfOperation.ctr(key)
    var decryptedBytes = aesCtr.decrypt(data)
    return utils.utf8.fromBytes(decryptedBytes)
}

export function encrypt(text) {
    if (!encrypted) return text
    let aesCtr = new ModeOfOperation.ctr(key)
    let textBytes = utils.utf8.toBytes(text)
    return aesCtr.encrypt(textBytes)
}
