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

    return {
        getCategories,
        categories
    }
}