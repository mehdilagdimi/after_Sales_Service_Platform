
    <div class="box-border flex flex-col justify-center items-center bg-gray-50 rounded-md p-2 mx-80">
        <form action="{{ route('storeResponse') }}" method="POST"
            class="box-border bg-white flex flex-col border-solid border-indigo-600 border-2 w-full p-5 rounded-md">
            @csrf

            <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
            {{-- <label for="response">Response</label> --}}
            <textarea name="body" id="response" cols="30" rows="4" required placeholder="Response.."
                class="text-black border-gray-200 border-solid border-2 p-3 m-3 rounded-md">
         </textarea>

            <button type="submit"
                class="py-2 px-6 mt-4 mx-auto bg-indigo-600 border-2 border-gray-200 rounded text-white font-semibold">
                Post answer </button>
        </form>
    </div>
