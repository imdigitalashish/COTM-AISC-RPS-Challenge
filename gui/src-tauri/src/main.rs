#![cfg_attr(
    all(not(debug_assertions), target_os = "windows"),
    windows_subsystem = "windows"
)]

use tauri::{window, LogicalSize, PhysicalSize, Size};

// Learn more about Tauri commands at https://tauri.app/v1/guides/features/command
#[tauri::command]
fn greet(name: &str) -> String {
    format!("Hello, {}! You've been greetedsdsd from Rust!", name)
}

fn main() {
    // window
    //     .set_size(Size::Physical(PhysicalSize {
    //         width: 100,
    //         height: 100,
    //     }))
    //     .unwrap();

    tauri::Builder::default()
        .invoke_handler(tauri::generate_handler![greet])
        .run(tauri::generate_context!())
        .expect("error while running tauri application");
}
