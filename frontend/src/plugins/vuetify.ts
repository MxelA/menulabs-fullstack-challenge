import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import * as labs from 'vuetify/labs/components'
// import components from 'vuetify/lib/components';
// import directives from 'vuetify/lib/directives';

const opts = {
    directives,
    components: {
        ...labs,
        ...components
    },
}
export default createVuetify(opts);