<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
      Meilleurs casinos en ligne fiables Juillet 2025 en France
    </h1>
    <div class="hidden md:grid grid-cols-12 gap-4 bg-blue-800 text-white p-4 rounded-t-lg items-center">
      <div class="col-span-1 font-semibold text-center">#</div>
      <div class="col-span-3 font-semibold">Casino</div>
      <div class="col-span-3 font-semibold text-center">Bonus</div>
      <div class="col-span-2 font-semibold text-center">Note</div>
      <div class="col-span-1 font-semibold text-center">Termes</div>
      <div class="col-span-2 font-semibold text-center">Obtenir le bonus</div>
    </div>
    <div v-for="(brand, i) in brands" :key="brand.name" class="bg-white rounded-lg shadow-md mb-6 md:rounded-none">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center p-4">
        <div class="md:col-span-1 flex items-center gap-2">
          <div :class="'bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded-t-md -mt-4 -ml-4 md:hidden'">EXCLUSIF</div>
          <span class="text-gray-500 font-bold text-xl hidden md:block text-center w-full">{{ i + 1 }}</span>
        </div>
        <div class="md:col-span-2 flex items-center gap-4">
          <img :alt="brand.name + ' logo'" class="w-16 h-16 md:w-20 md:h-20 rounded-full" :src="brand.logo" />
          <span class="font-semibold text-lg text-gray-800">{{ brand.name }}</span>
          <img v-if="brand.verified" alt="Verified icon" class="w-6 h-6 rounded-full" :src="brand.verified" />
        </div>
        <div class="md:col-span-3 text-center">
          <span v-if="brand.exclusive" class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-t-md relative -top-4">EXCLUSIF</span>
          <p class="text-lg font-bold text-gray-800">{{ brand.bonus }}</p>
          <p v-if="brand.bonusExtra" class="text-sm text-gray-600">{{ brand.bonusExtra }}</p>
        </div>
        <div class="md:col-span-2 flex justify-center items-center">
          <div class="flex text-yellow-400">
            <span v-for="n in 5" :key="n">★</span>
          </div>
        </div>
        <div class="md:col-span-1 flex justify-center">
          <div class="w-8 h-8 border border-gray-300 rounded-full flex items-center justify-center text-gray-500 text-sm">18+</div>
        </div>
        <div class="md:col-span-3 flex flex-col items-center space-y-2">
          <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg w-full md:w-auto">Obtenir le bonus</button>
          <a class="text-sm text-gray-600 hover:underline" :href="brand.siteUrl">Visiter le site</a>
        </div>
      </div>
      <div class="p-4 bg-gray-50 text-sm text-gray-700 md:rounded-b-lg">
        {{ brand.description }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const brands = ref([]);

onMounted(async () => {
  const res = await fetch('/toplist');
  if (res.ok) {
    const data = await res.json();
    brands.value = data.toplist.map((item, i) => ({
      name: item.brand.brand_name,
      logo: item.brand.brand_image,
      position: item.position,
      bonus: '200% jusquà 500€',
      bonusExtra: '+ 500 Tours Gratuits',
      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      exclusive: true,
      siteUrl: '#',
      verified: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBVNQmlkKOteStA5LRsg0BcAag1Nbsziy09M8cfNWf2X5MUzkI0BcBdqEzgOp0u95cf2gSKQ1GIG49AlFv_hm_I6ruKUV_rNnGy1eE4AnEnkGKbvaEd4-IKMwORN7kWhBrEhHFJuJKe_6YZe8RA5_EWcmtdWlFtr6UFxRu2KOhg5WOkbzyXaHmfrf-urYFzIfaK5ZIpXez-Vh7t8so--wdY0hk0ZhPsM1SFkv7iZi95Lal1rM_nOzHh9eR4X752QWE24OCp9F3EGho',
    }));
  }
});
</script>
