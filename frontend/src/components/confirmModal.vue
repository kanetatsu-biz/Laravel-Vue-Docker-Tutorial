<template>
    <div>
        <div class="modal">
            <p class="modal-message">{{ '本当に' + action_name + 'しますか？' }}</p>
            <div class="btn-container">
                <span class="modal-cancel" @click="$emit('confirm-method', false)">
                    いいえ
                </span>
                <button class="modal-btn" @click="$emit('confirm-method', true)">
                    {{ action_name + 'する' }}
                </button>
            </div>
        </div>
        <div id="modal-overlay"></div>
    </div>
</template>

<script>
export default {
    props: ['action_name'],
};
</script>

<style scoped>
.modal {
    background: white;
    z-index: 2;
    text-align: center;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
    width: 50%;
    height: 35%;
    display: flex;
    flex-flow: column;
    justify-content: center;
}

.modal-message {
    font-size: 20px;
}

.btn-container {
    display: flex;
    gap: 30px;
    justify-content: center;
    margin-top: 30px;
}

.modal-cancel {
    border: solid 2px black;
    border-radius: 3px;
    margin-right: 30px;
    transition: 0.4s;
}

.modal-cancel:hover {
    cursor: pointer;
    color: silver;
}

.modal-btn {
    color: red;
    border: solid 2px red;
    border-radius: 3px;
    transition: 0.4s;
    background-color: white;
}

.modal-btn:hover {
    background: red;
    color: white;
    cursor: pointer;
}

#modal-overlay {
    z-index: 1;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.75);
}
</style>