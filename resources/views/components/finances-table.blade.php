<section
    x-data="{
    inputStyle: 'bg-[#111827] rounded-full',
    containerStyle: 'flex flex-row gap-2 justify-center flex-wrap',
    cardStyle: 'flex flex-row flex-wrap bg-[#111827] p-5 rounded-[20px] justify-center items-center text-[25px] w-[230px] h-[150px]',
    }"
    class="flex flex-col gap-5"
>
    <div :class="containerStyle">

        <input type="text" :class="inputStyle" placeholder="Descrição">

        <input type="text" :class="inputStyle " placeholder="Valor">

         <select name="" :class="inputStyle ">
             <option value="" selected class="hidden">Selecione uma opção</option>
             <option value="">Entrada</option>
             <option value="">Saída</option>
         </select>

        <button class="bg-sky-500 rounded-full p-2">Adicionar</button>
    </div>
    
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