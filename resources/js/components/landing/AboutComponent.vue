<template>
    <v-row id="us" class="dark pt-10" no-gutters>
        <v-img :max-width="'60vw'" :src="club_src" class="hidden-sm-and-down"></v-img>
        <v-col class="pl-5 pr-15">
          <h1 class="aqua mb-5">THIS IS US</h1>
          <p>Are you an amateur runner?<br>Do you want to enjoy your favourite sport in company?</p>
          <p>We are a group of runners trying to achieve our goals in this fantastic sport. Whenever you join us, you will never again run alone.</p>
          <p>Even if you live abroad, you will always be able to interact with your teammates on our online events. We organise monthly events and online races so we can all work together and get motivation from our running friends.</p>
          <p>If you have any question about our club, get to our <a href="#contact" class="aqua">contact section</a> and let us help you.</p>
        </v-col>
        <v-img :max-width="'100vw'" :src="club2_src" class="hidden-md-and-up"></v-img>
    </v-row>
</template>

<script>
export default {
    data: () => ({
      club_src: 'resources/images/us.jpg',
      club2_src: 'resources/images/us2.jpg'
    }),
}
</script>