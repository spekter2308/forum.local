<template>
    <button type="submit" class="btn btn-outline-secondary">
        <span v-text="favouritesCount" aria-hidden="true" class="heart">
        </span>
    </button>
</template>

<script>
    export default {
        data() {
            return {
                favouritesCount: 10
            }
        }
    }
</script>

<style>

</style>