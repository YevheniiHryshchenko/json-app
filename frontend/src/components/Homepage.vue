<template>
  <div class="Homepage d-flex justify-content-center align-items-center">
    <Header :pageName="pageName" />
    <h2 class="m-0 d-inline">Content</h2>
  </div>
</template>
<script>
import Header from "@/components/Header";

export default {
  computed: {
    pageName() {
      return "Homepage";
    }
  },
  components: {
    Header
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/components/_Homepage.scss";
</style>
