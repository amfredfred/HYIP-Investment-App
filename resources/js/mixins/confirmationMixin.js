
import svaConfirm from '../components/confirm.vue';
export default {
    data() {
        return {
            showConfirm: false,
        }
    },
    methods: {
        show_confirmation() {
            this.showConfirm = true;
        },
        hide_confirmation() {
            this.showConfirm = false;
        },
        handle_confirmation(state) {
            if (state === false) {
                return this.hide_confirmation();
            }
        },
        get_confirmation() {
            
        }
    },
    components: { svaConfirm }
}