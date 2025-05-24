<template>
    <section class="main-section">
        <div class="catalog">КАТАЛОГ</div>
        <div class="content-wrapper">
            <div class="products-grid">
                <Link
                    v-for="product in filteredProducts"
                    :key="product.id"
                    :href="`/products/${product.id}`"
                    class="product-card"
                >
                    <img class="product-image" :src="`/images/${product.image}`">
                    <div class="title">{{ product.name }}</div>
                    <div class="price">{{ product.price }}р</div>
                </Link>
            </div>
            <div class="filter-container">
                <div class="filter">
                    <input type="checkbox" v-model="filters.kurs" id="check-kurs" />
                    <label for="check-kurs">Курсы</label>
                    <br>
                    <input type="checkbox" v-model="filters.books" id="check-books" />
                    <label for="check-books">Книги</label>
                    <br>
                    <input type="checkbox" v-model="filters.shabl" id="check-shabl" />
                    <label for="check-shabl">Шаблоны</label>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
// Импортируем Link из Inertia.js
import { Link } from '@inertiajs/vue3';

export default {
    // Регистрируем компонент Link, чтобы его можно было использовать в шаблоне
    components: {
        Link,
    },
    props: {
        products: {
            type: Array,
            required: true,
            default: () => [],
            validator: (value) => Array.isArray(value)
        }
    },
    data() {
        return {
            filters: {
                kurs: true,
                books: true,
                shabl: true
            }
        }
    },
    computed: {
        filteredProducts() {
            if (!this.products || !Array.isArray(this.products)) return [];
            return this.products.filter(product => {
                return (
                    (this.filters.kurs && product.category === 'kurs') ||
                    (this.filters.books && product.category === 'books') ||
                    (this.filters.shabl && product.category === 'shabl')
                );
            });
        }
    }
}
</script>

<style scoped>
.main-section {
    color: white;
    font-family: "Montserrat";
    width: 100%;
    min-height: 100vh;
    padding: 20px;
    box-sizing: border-box;
}

.catalog {
    font-size: 32px;
    margin-top: 50px;
    text-align: center;
    margin-bottom: 40px;
}

.content-wrapper {
    display: flex;
    max-width: 1400px;
    margin: 0 auto;
    gap: 40px;
}

.filter-container {
    width: 250px;
    position: sticky;
    top: 20px;
    height: fit-content;
}

.filter {
    padding: 20px;
    border: dashed 2px white;
    border-radius: 8px;
    font-size: 18px;
}

.filter input[type="checkbox"] {
    margin-right: 10px;
    accent-color: #884535;
    width: 18px;
    height: 18px;
}

.products-grid {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    align-content: start;
}

/* Изменения в стилях для product-card */
.product-card {
    border: dashed 2px white;
    border-radius: 8px;
    padding: 15px;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* Добавляем курсор-указатель, так как теперь это ссылка */
    cursor: pointer;
    /* Убираем подчеркивание для ссылки по умолчанию */
    text-decoration: none;
    /* Наследуем цвет текста от родителя или явно задаем */
    color: inherit; 
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.product-image {
    width: 100%;
    max-width: 200px;
    height: auto;
    border-radius: 5px;
    margin-bottom: 15px;
}

.title {
    font-size: 18px;
    margin-bottom: 8px;
    text-align: center;
}

.price {
    font-size: 20px;
    font-weight: bold;
    color: #ffd700;
    text-align: center;
}

/* Адаптация для мобильных */
@media (max-width: 1200px) {
    .products-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 900px) {
    .content-wrapper {
        flex-direction: column;
    }

    .filter-container {
        position: static;
        width: 100%;
        margin-bottom: 30px;
    }

    .products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .products-grid {
        grid-template-columns: 1fr;
    }
}
</style>