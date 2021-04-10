import moment from 'moment'

moment.locale('vi')

export default function TimeAgo(value) {
    return moment(value).fromNow()
}