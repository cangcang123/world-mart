import moment from 'moment'

window.moment = moment

export default function FDate(value, format = 'DD/MM/YYYY') {
    return moment(value).format(format)
}