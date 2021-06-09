<template>
    <v-footer padless id="footer">
      <v-card class="text-center">
        <v-card-text>
          <v-btn v-for="icon in icons" :key="icon" class="mx-4" icon>
            <v-icon size="24px">{{ icon }}</v-icon>
          </v-btn>
        </v-card-text>
        <a href="#"><img :src="logo_src" height="80"/></a>
        <v-card-text
          class="pt-0"
        >“Every morning in Africa, a gazelle wakes up, it knows it must outrun the fastest lion or it will be killed. Every morning in Africa, a lion wakes up. It knows it must run faster than the slowest gazelle, or it will starve. It doesn’t matter whether you’re the lion or a gazelle – when the sun comes up, you’d better be running.”<br><strong>Christopher McDougall</strong></v-card-text>
        <v-divider></v-divider>
        <v-card-text>
          <span>Designed and developed by Ignacio García Presa</span>
        </v-card-text>
        <v-card-text>
          <span>&#169;{{ new Date().getFullYear() }} —</span>
          <strong>Modern Runners</strong>
        </v-card-text>
      </v-card>
    </v-footer>
</template>

<script>
export default {
  name: "Footer",
  data: () => ({
    icons: [
      "fab fa-facebook",
      "fab fa-twitter",
      "fab fa-google-plus",
      "fab fa-instagram"
    ],
    logo_src: 'resources/images/logo-text.png'
  })
};
</script>