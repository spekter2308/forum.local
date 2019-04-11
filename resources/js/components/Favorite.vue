<template>
    <button type="submit" :class="classes" @click="toggle">
        <span class="heart"></span>
        <span v-text="count" aria-hidden="true"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                active: this.reply.isFavorited,
                count: this.reply.favoritesCount
            }
        },

        computed: {
            classes() {
                return [
                    'btn',
                    this.active ? 'btn-primary' : 'btn-light'
                ];
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },

            destroy() {
                axios.delete(this.endpoint);

                this.active = false;
                this.count--;
            },

            create() {
                axios.post(this.endpoint);

                this.active = true;
                this.count++;
            }
        }
    }
</script>

<style>

</style>