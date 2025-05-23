<template>
  <section class="main-section">
    <div class="slider" @click="handleSliderClick">
      <img class="slider-img" src="/images/banner1.png" />
      <img class="slider-img" src="/images/banner2.png" />
      <img class="slider-img" src="/images/banner3.png" />
    </div>
    <div class="popular">ПОПУЛЯРНЫЕ ТОВАРЫ</div>
    <div class="product">
      <div class="product1">
        <div class="photo">
          <img src="/images/kursreact.webp" style="border-radius: 3%; height: 330px;">
          <div class="title">Курс по реакту</div>
          <div class="price">800р</div>
        </div>
      </div>
      <div class="product1">
        <div class="photo">
          <img src="/images/kursjs.webp" style="border-radius: 3%; height: 330px;">
          <div class="title">Курс по js</div>
          <div class="price">570р</div>
        </div>
      </div>
      <div class="product1">
        <div class="photo">
          <img src="/images/svadba1.png" style="border-radius: 3%;">
          <div class="title3">Шаблон свадебный</div>
          <div class="price">190р</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AppMain',
  data() {
    return {
      imageIndex: 0,
      intervalId: null
    }
  },
  mounted() {
    this.show(this.imageIndex);
    this.startAutoSlide();
  },
  beforeUnmount() {
    this.stopAutoSlide();
  },
  methods: {
    show(index) {
      const images = document.querySelectorAll('.slider-img');
      images[this.imageIndex]?.classList?.remove('active');
      images[index]?.classList?.add('active');
      this.imageIndex = index;
    },
    prevImage() {
      let index = this.imageIndex - 1;
      if (index < 0) index = document.querySelectorAll('.slider-img').length - 1;
      this.show(index);
    },
    nextImage() {
      const images = document.querySelectorAll('.slider-img');
      let index = this.imageIndex + 1;
      if (index >= images.length) index = 0;
      this.show(index);
    },
    startAutoSlide() {
      this.intervalId = setInterval(this.nextImage, 12000);
    },
    stopAutoSlide() {
      if (this.intervalId) {
        clearInterval(this.intervalId);
        this.intervalId = null;
      }
    },
    handleSliderClick(event) {
      const slider = event.currentTarget;
      const clickPosition = event.clientX - slider.getBoundingClientRect().left;
      clickPosition < slider.offsetWidth / 2 ? this.prevImage() : this.nextImage();
    }
  }
}
</script>

<style scoped>
.main-section {
  background-color: #884535;
  color: white;
  font-family: "Mostserrat";
  width: 1880px;
  height: 1500px;
}

.popular {
  margin-top: 140px;
  text-align: center;
  font-size: 28px;
  font-family: "Montserrat";
}

.product {
  display: flex;
  margin: 90px auto;
  width: 1370px;
  height: 480px;
  gap: 90px;
}

.product1 {
  display: flex;
  width: 400px;
  height: 480px;
  border: dashed 2px white;
  border-radius: 2%;
}

.photo {
  width: 244px;
  height: 246px;
  margin: 40px auto;
  opacity: 90%;
}

.title {
  text-align: center;
  font-size: 24px;
  font-family: "Montserrat";
  margin-top: 10px;
}
.title3 {
  text-align: center;
  font-size: 22px;
  font-family: "Montserrat";
  margin-top: 10px;
}

.price {
  text-align: center;
  font-size: 24px;
  font-family: "Montserrat";
  margin-top: 10px;
}

.slider {
  width: 1881px;
  height: 580px;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  margin-top: 40px;
}

.slider-img {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  transition: opacity 0.5s ease;
  pointer-events: none;
}

.slider-img.active {
  opacity: 1;
}
</style>