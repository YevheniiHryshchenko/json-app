<template>
  <header class="header">
    <div class="left-col">
      <router-link to="/">Home</router-link>
    </div>
    <div class="middle-col">
      <span>{{ pageName }}</span>
    </div>
    <div class="right-col">
      <router-link to="/articles/page/1">Articles</router-link>
    </div>
  </header>
</template>
<script>

export default {
  data () {
    return {
    }
  },
  props: {
    pageName: {
      type: String,
      default: ""
    }
  },
  methods: {
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/layout/_AppHeader.scss";
</style>
