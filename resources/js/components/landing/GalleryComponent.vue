<template>
  <v-content id="gallery" class="pt-10">
    <v-container>
        <h1 class="aqua">OUR GALLERY</h1>
    </v-container>
    <v-carousel hide-delimiters cycle>
        <v-carousel-item
          v-for="(item,i) in carousel_items"
          :key="i"
          :src="item.src"
        ></v-carousel-item>
    </v-carousel>
  </v-content>
</template>

<script>
export default {
    data: () => ({
      carousel_items: [
        {
          src: 'resources/images/carousel/1.jpg',
        },
        {
          src: 'resources/images/carousel/2.jpg',
        },
        {
          src: 'resources/images/carousel/3.jpg',
        },
        {
          src: 'resources/images/carousel/4.jpg',
        },
        {
          src: 'resources/images/carousel/5.jpg',
        },
        {
          src: 'resources/images/carousel/7.jpg',
        },
        {
          src: 'resources/images/carousel/8.jpg',
        },
        {
          src: 'resources/images/carousel/10.jpg',
        },
      ],
    }),
}
</script>