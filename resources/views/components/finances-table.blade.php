<section
    x-data="{
    inputStyle: 'bg-[#111827] rounded-full',
    containerStyle: 'flex flex-row gap-2 justify-center flex-wrap',
    cardStyle: 'flex flex-row gap-3 flex-wrap bg-[#111827] p-5 rounded-[20px] justify-center items-center text-[25px] w-fit h-[150px]',
    description: '',
    type: '',
    price: '',
    

    }"
   
    class="flex flex-col gap-5"
>
    <section 
     x-data="{
    data: [],
    userId: @json(Auth::user() -> id),
    totalSpent: 0,
    totalIncome: 0,
    totalExpenses : 0,

    async recoverFinances() {
        console.log('Função chamada!')
         const res = await axios.get('/finances-recover');

        this.data = res.data.filter(item => item.user_id === this.userId);

        console.table(this.data);

        //console.log(this.data.filter(item => item.type === entrada));
        this.data.filter(item => {
            if(item.type === 'saida') {
                this.totalExpenses += Number(item.priceTotal);
            }

            if(item.type === 'entrada') {
                this.totalIncome += Number(item.priceTotal);
            }

            this.totalSpent = this.totalIncome -this.totalExpenses;
        });

    },

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
        this.recoverFinances();

        } catch (error) {
        console.log(error);
        }    

    }, 

    async deleteFinances(id) {

        const doesUserWantToDeleteRecord = confirm('Tem certeza que deseja deletar?')
        if(doesUserWantToDeleteRecord){
            const res = await axios.delete(`/delete-finance/${id}`);
            alert(res.data.message);
            this.recoverFinances();
    
        }
    },

   async init() {
       const res = await axios.get('/finances-recover');

        this.data = res.data.filter(item => item.user_id === this.userId);

        console.table(this.data);

        //console.log(this.data.filter(item => item.type === entrada));
        this.data.filter(item => {
            if(item.type === 'saida') {
                this.totalExpenses += Number(item.priceTotal);
            }

            if(item.type === 'entrada') {
                this.totalIncome += Number(item.priceTotal);
            }

            this.totalSpent = this.totalIncome -this.totalExpenses;
        });

    }
        }"
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
    
    <div>

        <template x-if="data.length > 0">
            <section class="flex flex-col gap-5">
                <div :class="containerStyle">
                    
                    <div :class="cardStyle">
                <h4>Renda:</h4>
                <h3>R$ <span x-text="totalIncome"></span></h3>
            </div>
            <div :class="cardStyle">
                <h4>Despesas:</h4>
                <h3>R$ <span x-text="totalExpenses"></span></h3>
            </div>
            <div :class="cardStyle">
                <h4>Total  de gastos:</h4>
                <h3>R$ <span x-text="totalSpent"></span></h3>
            </div>
        </div>
        
        <div :class="containerStyle">
            <table class="w-full bg-[#111827] rounded-[20px]">
                <thead class="border-b border-[#ccc]">
                    <tr>
                        <th class="py-[10px]">Descrição</th>
                        <th class="py-[10px]">Valor</th>
                        <th class="py-[10px]">Tipo</th>
                        <th class="py-[10px]">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="item in data" :key="item.id">
                    <tr class="">
                            <td class="text-center py-[10px]" x-text="item.description"></td>
                            <td class="text-center py-[10px]" x-text="item.priceTotal"></td>
                            <td class="text-center py-[10px]" x-text="item.type"></td>
                            <td class="text-center py-[10px]">
                                <button 
                                class="bg-red-500 p-2 rounded-[20px] border-none outline-none"
                                @click="deleteFinances(item.id)"
                                >
                                Deletar
                            </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
    
        </div>
     </section>


    </template>

    <template x-if="data.length === 0">
        <h3 class="text-center text-[25px]">Nenhum registro encontrado. Adicione suas finanças para começar.</h3>
    </template>

        </div>
</section>

</section>