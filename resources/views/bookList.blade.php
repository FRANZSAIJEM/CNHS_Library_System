<style>
.container {
        display: grid;
        place-items: center;
        margin-top: 50px;
    }
.content {

    width: 57.5%;
    margin: 0 auto;


    }

    .searchBtn{
        display: flex;
        text-align: right;
        justify-content: flex-end;
        margin-bottom: 30px;
        margin-right: 35px;
        align-items: center;
    }
    .searchInpt{
        width: 250px;
        text-align: center;
    }
    @media (max-width: 360px) and (max-height: 640px) {
    .content {
        width: 100%; /* Adjust width for smaller screens */

    }

    .searchBtn{
        text-align: right;
        margin-right: 15px;
        margin-bottom: -100px;
        transform: translateY(-110px)
    }
    .searchInpt{
        width: 100px
    }
    .bookList{
        margin-left: 50px;
    }
}
</style>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ALL BOOKS') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="content">
            <div class="searchBtn" style="display: flex; justify-content: flex-end;">
                <form action="{{ route('bookList') }}" method="GET">
                    <input class="searchInpt" style="border-radius: 20px; color: black;" type="text" name="book_search" placeholder="Title, Author, Subject">
                    <button type="submit" style="color: white; border-radius: 5px; background-color: rgb(4, 51, 71); padding: 10px;">Search</button>
                </form>
            </div>
            <div class="bookList" style="display: inline-flex; flex-wrap: wrap">
                @foreach ($bookList as $bookLists)

                    <div style="margin: 7px; border-radius: 5px; padding: 3px; background-color: white;">
                        <div style="background-position: center center; border-radius: 5px; width: 250px; height: 350px; background-size: cover; background-image: url('{{ asset('storage/' . $bookLists->image) }}');">
                            <div style="color: white; text-align: center; padding: 10px; text-shadow: 0px 0px 5px black">
                               <div style="margin-top: 75px;">
                                    <b style="font-size: 25px;">Title</b> <br>
                                    {{$bookLists->title}} <br>
                                    <b style="font-size: 25px;">Author</b> <br>
                                    {{$bookLists->author}} <br>
                                    <b style="font-size: 25px;">Subject</b> <br>
                                    {{$bookLists->subject}} <br>
                               </div>
                            </div>
                        </div>
                        @if (Auth::user()->is_admin)
                        <div style="text-align: center; margin-top: 4px;">
                            <form action="{{ route('editBook.edit', ['id' => $bookLists->id]) }}" method="GET" style="display: inline;">
                                @csrf
                                <button type="submit" style="background-color: rgb(60, 163, 60); width: 123px !important; border: none; border-radius: 5px; padding: 10px; color: white; text-decoration: none; cursor: pointer;"><b>Edit</b></button>
                            </form>

                            <!-- Button to trigger the modal -->
                            <button type="button" style="background-color: rgb(167, 55, 55); width: 123px; border-radius: 5px; padding: 10px; color: white;" onclick="showConfirmationModal({{ $bookLists->id }})"><b>Delete</b></button>
                        </div>

                        @endif
                    </div>

                @endforeach
            </div>
        </div>

        <div id="confirmDeleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
            <div style="background-color: white; border-radius: 5px; width: 300px; margin: 100px auto; padding: 20px; text-align: center;">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete this book?</p>
                <div>
                    <button style="background-color: rgb(60, 163, 60); color: white; padding: 10px 20px; margin-right: 10px; border-radius: 5px;" onclick="hideConfirmationModal()">Cancel</button>
                    <!-- Form to submit the delete request -->
                    <form action="{{ route('bookList.destroy', ['id' => '__BOOK_ID__']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button style="background-color: rgb(167, 55, 55); color: white; padding: 10px 20px; border-radius: 5px;" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function showConfirmationModal(bookId) {
            var modal = document.getElementById('confirmDeleteModal');
            modal.style.display = 'block';

            // Set the action of the form to include the specific book's ID
            var form = modal.querySelector('form');
            form.action = form.action.replace('__BOOK_ID__', bookId);
        }

        function hideConfirmationModal() {
            var modal = document.getElementById('confirmDeleteModal');
            modal.style.display = 'none';
        }
    </script>
</x-admin-layout>
