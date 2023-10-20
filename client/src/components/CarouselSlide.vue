<template>
  <div>
    <v-carousel
      :show-arrows="false"
      :show-indicators="false"
      hide-delimiters
      cycle
    >
      <div>
        <v-carousel-item
          v-for="(item, i) in items"
          :key="i"
        >
         <v-img class="image-cover" :src="item.src"></v-img>
        </v-carousel-item>
      </div>
    </v-carousel>
  </div>
</template>

<script>
export default {
  title: "CarouselSlide",
  data: () => ({
    items: [
      {
        src: require(`../assets/blogImage1.jpg`),
      },
      {
        src: require(`../assets/blogImage4.jpg`),
      }
    ],
  }),

  methods: {},
};
</script>

<style lang="scss" scoped>
.image-cover {
  pointer-events: none;
    object-fit: cover;
    height: 100%;
    width: 100%;
}
</style>
