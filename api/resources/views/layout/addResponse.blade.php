
    <div class="box-border flex flex-col justify-center items-center">
        <form action="{{ route('storeResponse') }}" method='POST'
            class="box-border bg-white flex flex-col border-solid border-red-400 border-2 w-4/6 max-w-2xl p-5">
            @csrf


            <label for="response">Response</label>
            <textarea name="body" id="response" cols="30" rows="4" required placeholder="Description.."
                class="text-black border-black border-solid border-2 p-3">
         </textarea>

            <button type="submit"
                class="py-2 px-6 mt-4 mx-auto bg-white border-2 border-orange-600 rounded text-orange-600 font-medium">
                Post Answer </button>
        </form>
    </div>
