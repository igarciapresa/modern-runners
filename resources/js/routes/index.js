import Events from '../pages/Events.vue'
import Profile from '../pages/Profile.vue'
import Teammates from '../pages/Teammates.vue'
import Trials from '../pages/Trials.vue'
import Messages from '../pages/Messages.vue'

export default {
    mode: 'abstract',
    routes: [
        {
            path: '/events',
            name: 'events',
            component: Events
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile
        },
        {
            path: '/teammates',
            name: 'teammates',
            component: Teammates
        },
        {
            path: '/trials',
            name: 'trials',
            component: Trials
        },
        {
            path: '/messages',
            name: 'messages',
            component: Messages
        }
    ]
}
