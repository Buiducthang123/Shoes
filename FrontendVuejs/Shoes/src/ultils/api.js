async function fetchAPI(url) {
    try {
        const response = await fetch(url);
        if (response.ok) {
            const data = await response.json();        
            return data;
        } else {
            console.log(`Không thể kết nối tới API ${{url}}`);
        }
    } catch (error) {
        console.error("Lỗi khi gọi API:", error);
    }
}
export default fetchAPI