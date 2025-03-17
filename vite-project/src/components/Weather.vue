<template>
    <div class="weather">
        <h1>Weather App</h1>

        <input v-model="city" placeholder="Enter city name" @keyup.enter="fetchWeather" />
        <button @click="fetchWeather">Get Weather</button>

        <div v-if="weather">
            <h2>{{ weather.name }}</h2>
            <p>Temperature: {{ weather.main.temp }}°C</p>
            <p>Condition: {{ weather.weather[0].description }}</p>
        </div>

        <p v-if="error" class="error">{{ error }}</p>
    </div>
</template>

<script>
let apiKey = '' // = import.meta.env.VITE_API_KEY
const apiUrl = import.meta.env.VITE_API_URL;

const response = await fetch(`${apiUrl}/JWT`, {
    headers: {
        'Accept': 'application/json'
    }

})
const data = await response.json();
apiKey = data.api_key;

export default {
    data() {
        return {
            city: '',
            weather: null,
            error: ''
        };
    },
    methods: {
        async fetchWeather() {
            this.error = '';
            if (!this.city) {
                this.error = 'Please enter a city name.';
                return;
            }

            try {
                const response = await fetch(`${apiUrl}/weather?city=${encodeURIComponent(this.city)}`, {
                    headers: {
                        'X-API-KEY': apiKey,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                this.weather = data;
            } catch (err) {
                console.error(err);
                this.error = 'Could not fetch weather data.';
            }
        }
    }
};
</script>

<style scoped>
.weather {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
}

input {
    margin-bottom: 10px;
    padding: 8px;
    width: 250px;
}

button {
    padding: 8px 12px;
    margin-bottom: 20px;
}

.error {
    color: red;
    margin-top: 10px;
}
</style>