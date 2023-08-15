<template>
  <div v-if="text" class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ text }}
    <button type="button" class="btn-close" @click="dismissAlert" aria-label="Close"></button>
  </div>
</template>

<script>
export default {
  name: "Alert",
  props:['text'],
  methods: {

    dismissAlert(){
      this.$emit("dismissAlert");
    }
  }
}
</script>

<style scoped>

</style>