# import serial

# serial_port ='COM4'
# baud_rate = 9600

# file_path = 'C:/wamp64/www/gestion_hopital/fingerprint/fingerprint.txt'

# with serial.Serial(serial_port, baud_rate) as ser:
#     fingerprint_data = ser.read(2048)
    
#     with open(file_path, 'wb') as file:
#         file.write(fingerprint_data)
    
#     ser.write(b'1')
    
# print("Empreinte enregistree dans le fichier :", file_path)


import tkinter as tk
import serial
import time

ser = serial.Serial('COM4', 57600)

root = tk.Tk()
root.title("Enrolement d'empreinte digital")

id_label = tk.Label(root, text='ID :')
id_label.pack()
id_entry = tk.Entry(root)
id_entry.pack()

def capture_fingerprint():
    
    fingerprint_id = id_entry.get()
    if not fingerprint_id:
        status_label.config(text="Veuillez saisir un ID.")
        return
    
    ser.write(b"E")
    time.sleep(0.1)
    ser.write(fingerprint_id.encode())
    time.sleep(0.1)
    
    response = ser.readline().decode().strip()
    if response == "OK":
        status_label.config(text=f"Enrolement reussi pour l'ID {fingerprint_id}.")
    elif response == "ID_EXIST":
        status_label.config(text=f"L'ID {fingerprint_id} existe deja.")
    elif response == "ERROR":
        status_label.config(text="Erreur lors de l'enrolement.")
    else:
        status_label.config(text="Reponse inattendue de l'Arduino.")
        
    id_entry.delete(0, tk.END)

capture_button = tk.Button(root, text="Capturer l'empreinte digitale", command=capture_fingerprint)
capture_button.pack()

status_label = tk.Label(root, text="")
status_label.pack()

root.mainloop()