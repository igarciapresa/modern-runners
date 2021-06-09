<template>
    <v-app-bar
      app
      hide-on-scroll
      height="100"
    >
      <v-toolbar-title><a href="#"><img :src="logo_src" height="60"/></a></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-xs-only">
        <v-btn text href="#us">ABOUT US</v-btn>
        <v-btn text href="#gallery">GALLERY</v-btn>
        <v-btn text href="#contact">CONTACT</v-btn>
      </v-toolbar-items>
      <div class="hidden-sm-and-up">
        <v-menu offset-y>
          <template v-slot:activator="{ on }">
            <v-app-bar-nav-icon v-on="on"></v-app-bar-nav-icon>
          </template>
          <v-list class="responsiveMenu">
            <v-list-item>
              <v-list-item-title><a href="#us">ABOUT US</a></v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><a href="#gallery">GALLERY</a></v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><a href="#contact">CONTACT</a></v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>
    </v-app-bar>
</template>

<script>
export default {
  name: "Nav",
  data(){
    return{
      logo_src: 'resources/images/logo.png',
    }
  },
};
</script>
