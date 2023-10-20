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
          :src="item.src"
        ></v-carousel-item>
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
        src: require(`../assets/blogImage2.jpg`),
      },
      {
        src: require(`../assets/blogImage3.jpg`),
      },
    ],
  }),

  methods: {},
};
</script>
