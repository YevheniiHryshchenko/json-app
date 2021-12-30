<template>
  <div class="article">
    <h2>Media</h2>
    <div class="overflow-auto">
      <template v-for="media in data.media">
        <template v-if="media.is_featured">
          <img
            :key="media.id"
            :src="JSON.parse(media.info).attributes.url"
            :height="JSON.parse(media.info).attributes.height"
            :width="JSON.parse(media.info).attributes.width"
            alt="image"
          >
        </template>
      </template>
      <img
        v-if="isPlaceholderNeeded"
        src="http://placehold.jp/24/cccccc/ffffff/1200x628.png?text=PLACEHOLDER"
        alt="image"
      >
    </div>
    <hr>
    <h2>Title</h2>
    <p>{{ data.title }}</p>
    <hr>
    <h2>Slug</h2>
    <p>{{ data.slug }}</p>
    <hr>
    <h2>Content</h2>
    <div>
      <div class="content" v-for="(content, index) in data.content" :key="content.id">
        <h5>Element {{index + 1}}</h5>
        <hr>
        <div v-html="content.content" class="overflow-auto"></div>
      </div>
    </div>
    <hr>
    <h2>Category</h2>
    <p>{{data.categories[0].name}}</p>
  </div>
</template>
<script>
export default {
  props: ["data"],
  computed: {
    isPlaceholderNeeded() {
      for (let i = 0; i < this.data.media.length; i++) {
        if (this.data.media[i].is_featured) return false;
      }

      return true;
    }
  },
  methods: {
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/components/_Article.scss";
</style>
