<template>
    <!--@if (auth()->check())-->
    <!--<form method="POST" action="{{ $thread->path() . '/replies' }}">-->
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea name="body"
                      id="body"
                      class="form-control"
                      placeholder="Have something to say?"
                      rows="5"
                      required
                      v-model="body"></textarea>
        </div>

        <button type="submit"
                class="btn btn-primary"
                @click="addReply">
        </button>
    <!--</form>-->
    <!--@else-->
    <!--<p class="text-center">Please <a href="{{ route('login') }}">sing in</a> to partisipate this
        disscussion</p>-->
    <!--@endif-->
</template>

<script>
    export default {
        data() {
            return {
                body: '',
                endpoint: ''
            }
        },

        methods: {
            addReply() {
                axios.post(this.endpoint, {body: this.body})
                     .then(response => {
                         this.body = '';

                         flash('Your reply has been posted.');

                         this.$emit('created', response.data);
                     });
            }
        }
    }
</script>

<style>

</style>