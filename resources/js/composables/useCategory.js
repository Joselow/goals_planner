import { ref } from 'vue'

export function useCategory() {
    const categories = ref([])

    const getCategories = async () => {
        try {
            const { data } = await window.axios({
                method: 'GET',
                url: '/categories'
            })
            
            if (data && Array.isArray(data)) {
                categories.value = data
            }
            
            console.log(data);
        } catch (error) {
            console.error(error);   
        }
    }

    const createCategory = async ({ name, color }) => {
        try {
            const { data } = await window.axios({
                method: 'POST',
                url: 'categories/create',
                data: { name, color }
            })
            alert('Categoria creada correctamente')
            console.log(data);
            // closeCategoryModal()

            return {
                success: true,
                data
            }
        } catch (error) {
            alert(error.response?.data?.message);

            return {
                success: false,
                data: null
            }
        }
    }

    return {
        getCategories,
        categories,
        createCategory
    }
}