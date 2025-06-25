<section
    x-data="{
    inputStyle: 'bg-[#111827] rounded-full',
    containerStyle: 'flex flex-row gap-2 justify-center flex-wrap',
    cardStyle: 'flex flex-row flex-wrap bg-[#111827] p-5 rounded-[20px] justify-center items-center text-[25px] w-[230px] h-[150px]',
    description: '',
    type: '',
    price: '',
    data: [],
     async saveFinances() {
        if(this.description === '' || this.type === '' || this.price === '') {
            alert('Preencha todos os campos');
            return;
        }

        const FormatPrice = this.price.replace('.', ',');

        const obj = {
            description: this.description,
            type: this.type,
            price: FormatPrice,
        }

        const res = await axios.post('/finances', obj);

        try {
        alert(res.data.message);
        this.description = '';
        this.type = '';
        this.price = '';

        } catch (error) {
        console.log(error);
        }    

    }, 

    async getFinances() {
        const res = await axios.get('/finances-recover');
        console.log('teste');
    }

    }"
    x-effect="await axios.get('/finances-recover')"
    class="flex flex-col gap-5"
>
    <div :class="containerStyle">

        <form @submit.prevent="saveFinances">
            @csrf
            <input type="text" :class="inputStyle" placeholder="Descrição" x-model="description">
            
            <input type="number" :class="inputStyle " placeholder="Valor" x-model="price">
            
            <select :class="inputStyle" x-model="type">
                <option selected class="hidden" value="">Selecione uma opção</option>
                <option value="Entrada">Entrada</option>
                <option value="Saida">Saída</option>
            </select>
            
            <button class="bg-sky-500 rounded-full p-2">Adicionar</button>
        </form>
    </div>
    
    <template x-if="data.length > 0">
     <section class="flex flex-col gap-5">
           <div :class="containerStyle">
    
            <div :class="cardStyle">
                <h4 style="font-size: 25px">Teste</h4>
                <h3>R$ 10,00</h3>
            </div>
            <div :class="cardStyle">
                <h4>Teste</h4>
                <h3>R$ 10,00</h3>
            </div>
            <div :class="cardStyle">
                <h4>Teste</h4>
                <h3>R$ 10,00</h3>
            </div>
        </div>
        
        <div :class="containerStyle">
            <table class="w-full bg-[#111827] rounded-[20px]">
                <thead class="border-b border-[#ccc]">
                    <tr>
                        <th class="py-[10px]">Descrição</th>
                        <th class="py-[10px]">Valor</th>
                        <th class="py-[10px]">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td class="text-center py-[10px]">Teste</td>
                        <td class="text-center py-[10px]">R$ 10,00</td>
                        <td class="text-center py-[10px]">Entrada</td>
                    </tr>
                </tbody>
            </table>
    
        </div>
     </section>
    </template>

    <template x-if="data.length === 0">
        <h3 class="text-center text-[25px]">Nenhum registro encontrado. Adicione suas finanças para começar.</h3>
    </template>

</section>